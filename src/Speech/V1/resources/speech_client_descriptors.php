<?php

return [
    'recognize' => [],
    'longRunningRecognize' => [
        'longRunningDescriptor' => [
            'operationReturnType' => '\Google\Cloud\Speech\V1\LongRunningRecognizeResponse',
            'metadataReturnType' => '\Google\Cloud\Speech\V1\LongRunningRecognizeMetadata',
        ]
    ],
    'streamingRecognize' => [
        'grpcStreamingDescriptor' => [
            'grpcStreamingType' => 'BidiStreaming',
        ]
    ]
];
