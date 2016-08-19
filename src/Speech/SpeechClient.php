<?php
/**
 * Copyright 2016 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\Speech;

use Google\Cloud\ClientTrait;
use Google\Cloud\Speech\Connection\ConnectionInterface;
use Google\Cloud\Speech\Connection\Rest;
use Google\Cloud\Storage\Object;

/**
 * Google Cloud Speech client. The Cloud Speech API enables easy integration of
 * Google speech recognition technologies into developer applications. Send
 * audio and receive a text transcription from the Cloud Speech API service.
 * Find more information at the
 * [Google Cloud Speech docs](https://cloud.google.com/speech/docs/).
 */
class SpeechClient
{
    use ClientTrait;

    const FULL_CONTROL_SCOPE = 'https://www.googleapis.com/auth/cloud-platform';

    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * Create a Speech client.
     *
     * Example:
     * ```
     * use Google\Cloud\ServiceBuilder;
     *
     * $cloud = new ServiceBuilder([
     *     'projectId' => 'my-awesome-project'
     * ]);
     *
     * $speech = $cloud->speech();
     * ```
     *
     * ```
     * // The Speech client can also be instantianted directly.
     * use Google\Cloud\Speech\SpeechClient;
     *
     * $speech = new SpeechClient([
     *     'projectId' => 'my-awesome-project'
     * ]);
     * ```
     *
     * @param array $config {
     *     Configuration Options.
     *
     *     @type string $projectId The project ID from the Google Developer's
     *           Console.
     *     @type callable $authHttpHandler A handler used to deliver Psr7
     *           requests specifically for authentication.
     *     @type callable $httpHandler A handler used to deliver Psr7 requests.
     *     @type string $keyFile The contents of the service account
     *           credentials .json file retrieved from the Google Developers
     *           Console.
     *     @type string $keyFilePath The full path to your service account
     *           credentials .json file retrieved from the Google Developers
     *           Console.
     *     @type int $retries Number of retries for a failed request. Defaults
     *           to 3.
     *     @type array $scopes Scopes to be used for the request.
     * }
     * @throws \InvalidArgumentException
     */
    public function __construct(array $config = [])
    {
        if (!isset($config['scopes'])) {
            $config['scopes'] = [self::FULL_CONTROL_SCOPE];
        }

        $this->connection = new Rest($this->configureAuthentication($config));
    }

    /**
     * Runs a recognize request and returns the results immediately. Ideal when
     * working with audio up to approximately one minute in length.
     *
     * The Google Cloud Client Library will attempt to infer the sample rate
     * and encoding used by the provided audio file for you. This feature is
     * recommended only if you are unsure of what the values may be and is
     * currently limited to .flac, .amr, and .awb file types. The sample rate
     * cannot be inferred from audio provided from a Google Storage object.
     *
     * Example:
     * ```
     * $transcriptions = $speech->recognize(fopen('audio.flac'));
     *
     * foreach ($transcriptions as $transcription) {
     *     echo $transcription['transcript'];
     * }
     * ```
     *
     * ```
     * // Run with speech context, sample rate, and encoding provided
     * $transcriptions = $speech->recognize(fopen('audio.flac'), [
     *     'encoding' => 'FLAC',
     *     'sampleRate' => 16000,
     *     'speechContext' => [
     *         'phrases' => [
     *             'The Google Cloud Platform',
     *             'Speech API'
     *         ]
     *     ]
     * ]);
     *
     * foreach ($transcriptions as $transcription) {
     *     echo $transcription['transcript'];
     * }
     * ```
     *
     * @codingStandardsIgnoreStart
     * @see https://cloud.google.com/speech/reference/rest/Shared.Types/SpeechRecognitionAlternative SpeechRecognitionAlternative
     * @see https://cloud.google.com/speech/reference/rest/v1beta1/speech/syncrecognize SyncRecognize API documentation
     * @see https://cloud.google.com/speech/reference/rest/Shared.Types/AudioEncoding AudioEncoding types
     * @see https://cloud.google.com/speech/docs/best-practices Speech API best practices
     *
     * @param resource|string|Object $audio The audio to recognize. May be a
     *        resource, string of bytes, or Google Cloud Storage object.
     * @param array $options {
     *     Configuration options.
     *
     *     @type int $sampleRate Sample rate in Hertz of the provided audio.
     *           Valid values are: 8000-48000. 16000 is optimal. For best
     *           results, set the sampling rate of the audio source to 16000 Hz.
     *           If that's not possible, use the native sample rate of the audio
     *           source (instead of re-sampling).
     *     @type string $encoding Encoding of the provided audio. May be one of
     *           `LINEAR16`, `FLAC`, `MULAW`, `AMR`, `AMR_WB`.
     *     @type int $maxAlternatives Maximum number of alternatives to be
     *           returned. Valid values are 0-30. A value of 0 or 1 will return
     *           a maximum of 1. Defaults to `1`.
     *     @type string $languageCode The language of the content. BCP-47
     *           (e.g., en-US, es-ES) language codes are accepted. Defaults to
     *           English.
     *     @type bool $profanityFilter If set to `true`, the server will attempt
     *           to filter out profanities, replacing all but the initial
     *           character in each filtered word with asterisks, e.g. \"f***\".
     *           Defaults to `false`.
     *     @type array $speechContext Must contain a key `phrases` which is to
     *           be an array of strings which provide "hints" to the speech
     *           recognizer to favor specific words and phrases in the results.
     *           Please see [SpeechContext](https://cloud.google.com/speech/reference/rest/Shared.Types/RecognitionConfig#SpeechContext)
     *           for more information.
     * }
     * @codingStandardsIgnoreEnd
     * @return array The transcribed results. Each element of the array contains
     *         a `transcript` key which holds the transcribed text. Optionally
     *         a `confidence` key holding the confidence estimate ranging from
     *         0.0 to 1.0 may be present.
     * @throws \InvalidArgumentException
     */
    public function recognize($audio, array $options = [])
    {
        $response = $this->connection->syncRecognize(
            $this->formatRequest($audio, $options)
        );

        return isset($response['results']) ? $response['results'][0]['alternatives'] : [];
    }

    /**
     * Runs a recognize request as an operation. Ideal when working with audio
     * longer than approximately one minute. Requires polling of the returned
     * operation in order to fetch results.
     *
     * The Google Cloud Client Library will attempt to infer the sample rate
     * and encoding used by the provided audio file for you. This feature is
     * recommended only if you are unsure of what the values may be and is
     * currently limited to .flac, .amr, and .awb file types. The sample rate
     * cannot be inferred from audio provided from a Google Storage object.
     *
     * For longer audio, up to approximately 80 minutes, you must use Google
     * Cloud Storage objects as input. In addition to this restriction, only
     * LINEAR16 audio encoding can be used for long audio inputs.
     *
     * Example:
     * ```
     * $operation = $speech->beginRecognizeOperation(fopen('audio.flac'));
     * $isComplete = $operation->isComplete();
     *
     * while (!$isComplete) {
     *     sleep(1); // let's wait for a moment...
     *     $operation->reload();
     *     $isComplete = $operation->isComplete();
     * }
     *
     * print_r($operation->results());
     * ```
     *
     * ```
     * // Run with speech context, sample rate, and encoding provided
     * $operation = $speech->beginRecognizeOperation(fopen('audio.flac'), [
     *     'encoding' => 'FLAC',
     *     'sampleRate' => 16000,
     *     'speechContext' => [
     *         'phrases' => [
     *             'The Google Cloud Platform',
     *             'Speech API'
     *         ]
     *     ]
     * ]);
     * $isComplete = $operation->isComplete();
     *
     * while (!$isComplete) {
     *     sleep(1); // let's wait for a moment...
     *     $operation->reload();
     *     $isComplete = $operation->isComplete();
     * }
     *
     * print_r($operation->results());
     * ```
     *
     * @codingStandardsIgnoreStart
     * @see https://cloud.google.com/speech/reference/rest/v1beta1/speech/asyncrecognize AsyncRecognize API documentation
     * @see https://cloud.google.com/speech/reference/rest/Shared.Types/AudioEncoding AudioEncoding types
     * @see https://cloud.google.com/speech/docs/best-practices Speech API best practices
     *
     * @param resource|string|Object $audio The audio to recognize. May be a
     *        resource, string of bytes, or Google Cloud Storage object.
     * @param array $options {
     *     Configuration options.
     *
     *     @type int $sampleRate Sample rate in Hertz of the provided audio.
     *           Valid values are: 8000-48000. 16000 is optimal. For best
     *           results, set the sampling rate of the audio source to 16000 Hz.
     *           If that's not possible, use the native sample rate of the audio
     *           source (instead of re-sampling).
     *     @type string $encoding Encoding of the provided audio. May be one of
     *           `LINEAR16`, `FLAC`, `MULAW`, `AMR`, `AMR_WB`.
     *     @type int $maxAlternatives Maximum number of alternatives to be
     *           returned. Valid values are 0-30. A value of 0 or 1 will return
     *           a maximum of 1. Defaults to `1`.
     *     @type string $languageCode The language of the content. BCP-47
     *           (e.g., en-US, es-ES) language codes are accepted. Defaults to
     *           English.
     *     @type bool $profanityFilter If set to `true`, the server will attempt
     *           to filter out profanities, replacing all but the initial
     *           character in each filtered word with asterisks, e.g. \"f***\".
     *           Defaults to `false`.
     *     @type array $speechContext Must contain a key `phrases` which is to
     *           be an array of strings which provide "hints" to the speech
     *           recognizer to favor specific words and phrases in the results.
     *           Please see [SpeechContext](https://cloud.google.com/speech/reference/rest/Shared.Types/RecognitionConfig#SpeechContext)
     *           for more information.
     * }
     * @codingStandardsIgnoreEnd
     * @return Operation
     * @throws \InvalidArgumentException
     */
    public function beginRecognizeOperation($audio, array $options = [])
    {
        $response = $this->connection->asyncRecognize(
            $this->formatRequest($audio, $options)
        );

        return new Operation(
            $this->connection,
            $response['name'],
            $response
        );
    }

    /**
     * Lazily instantiates an operation. There are no network requests made at
     * this point. To see the operations that can be performed on an operation
     * please see {@see Google\Cloud\Speech\Operation}.
     *
     * Example:
     * ```
     * $operation = $speech->operation('operationName');
     * ```
     *
     * @param string $name The name of the operation to request.
     * @return Operation
     */
    public function operation($name)
    {
        return new Operation($this->connection, $name);
    }

    /**
     * Formats the request for the API.
     *
     * @param resource|string|Object $audio
     * @param array $options
     * @return array
     * @throws \InvalidArgumentException
     */
    private function formatRequest($audio, array $options)
    {
        $recognizeOptions = [
            'encoding',
            'sampleRate',
            'languageCode',
            'maxAlternatives',
            'profanityFilter',
            'speechContext'
        ];

        $options['sampleRate'] = isset($options['sampleRate']) ? (int) $options['sampleRate'] : null;
        $options['encoding'] = isset($options['encoding']) ? strtoupper($options['encoding']) : null;
        $fileFormat = null;

        if ($audio instanceof Object) {
            $objIdentity = $audio->identity();
            $options['audio']['uri'] = 'gs://' . $objIdentity['bucket'] . '/' . $objIdentity['object'];
            $fileFormat = pathinfo($options['audio']['uri'], PATHINFO_EXTENSION);
        } elseif (is_resource($audio)) {
            $fileFormat = pathinfo(stream_get_meta_data($audio)['uri'], PATHINFO_EXTENSION);
            $options['audio']['content'] = base64_encode(stream_get_contents($audio));
        } else {
            $options['audio']['content'] = base64_encode($audio);
        }

        if (!$options['encoding'] || !$options['sampleRate']) {
            list($options['encoding'], $options['sampleRate']) = $this->determineEncodingAndSampleRate(
                $audio,
                $options['encoding'],
                $options['sampleRate'],
                $fileFormat
            );
        }

        if (!isset($options['encoding'])) {
            throw new \InvalidArgumentException('Unable to determine encoding. Please provide the value manually.');
        }

        if (!isset($options['sampleRate'])) {
            throw new \InvalidArgumentException('Unable to determine sample rate. Please provide the value manually.');
        }

        foreach ($options as $option => $value) {
            if (in_array($option, $recognizeOptions)) {
                $options['config'][$option] = $value;
                unset($options[$option]);
            }
        }

        return $options;
    }

    /**
     * Attempts to determine the encoding and sample rate by analyzing the
     * contents of the file (if possible) or inferring based on the file format.
     *
     * @param resource|string $audio
     * @param string $encoding
     * @param int $sampleRate
     * @param string $fileFormat
     * @return resource
     */
    private function determineEncodingAndSampleRate($audio, $encoding, $sampleRate, $fileFormat = null)
    {
        $info = [];

        if (class_exists('getID3') && !($audio instanceof Object)) {
            $audioResource = $this->getResource($audio);
            $path = stream_get_meta_data($audioResource)['uri'];
            $info = (new \getID3())->analyze($path);
            fclose($audioResource);
        }

        if (!$encoding) {
            $encoding = isset($info['fileformat'])
                ? $this->determineEncoding($info['fileformat'])
                : $this->determineEncoding($fileFormat);
        }

        if (!$sampleRate) {
            $sampleRate = isset($info['audio']['sample_rate'])
                ? $info['audio']['sample_rate']
                : $this->determineSampleRate($encoding);
        }

        return [
            $encoding,
            $sampleRate
        ];
    }

    /**
     * Returns a resource.
     *
     * @param resource|string $audio
     * @return resource
     */
    private function getResource($audio)
    {
        if (is_resource($audio)) {
            $type = stream_get_meta_data($audio)['wrapper_type'];

            // If the file is remote download and store it temporarily
            if ($type === 'http' || $type === 'ftp') {
                $temp = tmpfile();
                stream_copy_to_stream($audio, $temp);
                fclose($audio);

                return $temp;
            }

            return $audio;
        }

        // If the file is a string store it temporarily
        $temp = tmpfile();
        fwrite($temp, $audio);

        return $temp;
    }

    /**
     * Attempts to determine the encoding based on the file format.
     *
     * @param string $fileFormat
     * @return int|null
     */
    private function determineEncoding($fileFormat)
    {
        switch ($fileFormat) {
            case 'flac':
                return 'FLAC';
            case 'amr':
                return 'AMR';
            case 'awb':
                return 'AMR_WB';
            default:
                return null;
        }
    }

    /**
     * Attempts to determine the sample rate based on the encoding.
     *
     * @param string $encoding
     * @return int|null
     */
    private function determineSampleRate($encoding)
    {
        switch ($encoding) {
            case 'AMR':
                return 8000;
            case 'AMR_WB':
                return 16000;
            default:
                return null;
        }
    }
}
