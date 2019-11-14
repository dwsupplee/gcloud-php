<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/automl/v1/service.proto

namespace GPBMetadata\Google\Cloud\Automl\V1;

class Service
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\Annotations::initOnce();
        \GPBMetadata\Google\Api\Client::initOnce();
        \GPBMetadata\Google\Api\Resource::initOnce();
        \GPBMetadata\Google\Cloud\Automl\V1\AnnotationPayload::initOnce();
        \GPBMetadata\Google\Cloud\Automl\V1\AnnotationSpec::initOnce();
        \GPBMetadata\Google\Cloud\Automl\V1\Dataset::initOnce();
        \GPBMetadata\Google\Cloud\Automl\V1\Image::initOnce();
        \GPBMetadata\Google\Cloud\Automl\V1\Io::initOnce();
        \GPBMetadata\Google\Cloud\Automl\V1\Model::initOnce();
        \GPBMetadata\Google\Cloud\Automl\V1\ModelEvaluation::initOnce();
        \GPBMetadata\Google\Longrunning\Operations::initOnce();
        \GPBMetadata\Google\Protobuf\FieldMask::initOnce();
        \GPBMetadata\Google\Cloud\Automl\V1\Operations::initOnce();
        $pool->internalAddGeneratedFile(hex2bin(
            "0ac02b0a24676f6f676c652f636c6f75642f6175746f6d6c2f76312f7365" .
            "72766963652e70726f746f1216676f6f676c652e636c6f75642e6175746f" .
            "6d6c2e76311a17676f6f676c652f6170692f636c69656e742e70726f746f" .
            "1a19676f6f676c652f6170692f7265736f757263652e70726f746f1a2f67" .
            "6f6f676c652f636c6f75642f6175746f6d6c2f76312f616e6e6f74617469" .
            "6f6e5f7061796c6f61642e70726f746f1a2c676f6f676c652f636c6f7564" .
            "2f6175746f6d6c2f76312f616e6e6f746174696f6e5f737065632e70726f" .
            "746f1a24676f6f676c652f636c6f75642f6175746f6d6c2f76312f646174" .
            "617365742e70726f746f1a22676f6f676c652f636c6f75642f6175746f6d" .
            "6c2f76312f696d6167652e70726f746f1a1f676f6f676c652f636c6f7564" .
            "2f6175746f6d6c2f76312f696f2e70726f746f1a22676f6f676c652f636c" .
            "6f75642f6175746f6d6c2f76312f6d6f64656c2e70726f746f1a2d676f6f" .
            "676c652f636c6f75642f6175746f6d6c2f76312f6d6f64656c5f6576616c" .
            "756174696f6e2e70726f746f1a23676f6f676c652f6c6f6e6772756e6e69" .
            "6e672f6f7065726174696f6e732e70726f746f1a20676f6f676c652f7072" .
            "6f746f6275662f6669656c645f6d61736b2e70726f746f1a27676f6f676c" .
            "652f636c6f75642f6175746f6d6c2f76312f6f7065726174696f6e732e70" .
            "726f746f22580a144372656174654461746173657452657175657374120e" .
            "0a06706172656e7418012001280912300a07646174617365741802200128" .
            "0b321f2e676f6f676c652e636c6f75642e6175746f6d6c2e76312e446174" .
            "6173657422210a114765744461746173657452657175657374120c0a046e" .
            "616d65180120012809225c0a134c69737444617461736574735265717565" .
            "7374120e0a06706172656e74180120012809120e0a0666696c7465721803" .
            "2001280912110a09706167655f73697a6518042001280512120a0a706167" .
            "655f746f6b656e18062001280922620a144c697374446174617365747352" .
            "6573706f6e736512310a08646174617365747318012003280b321f2e676f" .
            "6f676c652e636c6f75642e6175746f6d6c2e76312e446174617365741217" .
            "0a0f6e6578745f706167655f746f6b656e18022001280922790a14557064" .
            "617465446174617365745265717565737412300a07646174617365741801" .
            "2001280b321f2e676f6f676c652e636c6f75642e6175746f6d6c2e76312e" .
            "44617461736574122f0a0b7570646174655f6d61736b18022001280b321a" .
            "2e676f6f676c652e70726f746f6275662e4669656c644d61736b22240a14" .
            "44656c6574654461746173657452657175657374120c0a046e616d651801" .
            "20012809225c0a11496d706f72744461746152657175657374120c0a046e" .
            "616d6518012001280912390a0c696e7075745f636f6e6669671803200128" .
            "0b32232e676f6f676c652e636c6f75642e6175746f6d6c2e76312e496e70" .
            "7574436f6e666967225e0a114578706f7274446174615265717565737412" .
            "0c0a046e616d65180120012809123b0a0d6f75747075745f636f6e666967" .
            "18032001280b32242e676f6f676c652e636c6f75642e6175746f6d6c2e76" .
            "312e4f7574707574436f6e66696722280a18476574416e6e6f746174696f" .
            "6e5370656352657175657374120c0a046e616d6518012001280922520a12" .
            "4372656174654d6f64656c52657175657374120e0a06706172656e741801" .
            "20012809122c0a056d6f64656c18042001280b321d2e676f6f676c652e63" .
            "6c6f75642e6175746f6d6c2e76312e4d6f64656c221f0a0f4765744d6f64" .
            "656c52657175657374120c0a046e616d65180120012809225a0a114c6973" .
            "744d6f64656c7352657175657374120e0a06706172656e74180120012809" .
            "120e0a0666696c74657218032001280912110a09706167655f73697a6518" .
            "042001280512120a0a706167655f746f6b656e180620012809225b0a124c" .
            "6973744d6f64656c73526573706f6e7365122c0a056d6f64656c18012003" .
            "280b321d2e676f6f676c652e636c6f75642e6175746f6d6c2e76312e4d6f" .
            "64656c12170a0f6e6578745f706167655f746f6b656e1802200128092222" .
            "0a1244656c6574654d6f64656c52657175657374120c0a046e616d651801" .
            "2001280922730a125570646174654d6f64656c52657175657374122c0a05" .
            "6d6f64656c18012001280b321d2e676f6f676c652e636c6f75642e617574" .
            "6f6d6c2e76312e4d6f64656c122f0a0b7570646174655f6d61736b180220" .
            "01280b321a2e676f6f676c652e70726f746f6275662e4669656c644d6173" .
            "6b22be020a124465706c6f794d6f64656c52657175657374127f0a30696d" .
            "6167655f6f626a6563745f646574656374696f6e5f6d6f64656c5f646570" .
            "6c6f796d656e745f6d6574616461746118022001280b32432e676f6f676c" .
            "652e636c6f75642e6175746f6d6c2e76312e496d6167654f626a65637444" .
            "6574656374696f6e4d6f64656c4465706c6f796d656e744d657461646174" .
            "614800127c0a2e696d6167655f636c617373696669636174696f6e5f6d6f" .
            "64656c5f6465706c6f796d656e745f6d6574616461746118042001280b32" .
            "422e676f6f676c652e636c6f75642e6175746f6d6c2e76312e496d616765" .
            "436c617373696669636174696f6e4d6f64656c4465706c6f796d656e744d" .
            "657461646174614800120c0a046e616d65180120012809421b0a196d6f64" .
            "656c5f6465706c6f796d656e745f6d6574616461746122240a14556e6465" .
            "706c6f794d6f64656c52657175657374120c0a046e616d65180120012809" .
            "226a0a124578706f72744d6f64656c52657175657374120c0a046e616d65" .
            "18012001280912460a0d6f75747075745f636f6e66696718032001280b32" .
            "2f2e676f6f676c652e636c6f75642e6175746f6d6c2e76312e4d6f64656c" .
            "4578706f72744f7574707574436f6e66696722290a194765744d6f64656c" .
            "4576616c756174696f6e52657175657374120c0a046e616d651801200128" .
            "0922640a1b4c6973744d6f64656c4576616c756174696f6e735265717565" .
            "7374120e0a06706172656e74180120012809120e0a0666696c7465721803" .
            "2001280912110a09706167655f73697a6518042001280512120a0a706167" .
            "655f746f6b656e180620012809227a0a1c4c6973744d6f64656c4576616c" .
            "756174696f6e73526573706f6e736512410a106d6f64656c5f6576616c75" .
            "6174696f6e18012003280b32272e676f6f676c652e636c6f75642e617574" .
            "6f6d6c2e76312e4d6f64656c4576616c756174696f6e12170a0f6e657874" .
            "5f706167655f746f6b656e180220012809328d170a064175746f4d6c129b" .
            "010a0d43726561746544617461736574122c2e676f6f676c652e636c6f75" .
            "642e6175746f6d6c2e76312e437265617465446174617365745265717565" .
            "73741a1d2e676f6f676c652e6c6f6e6772756e6e696e672e4f7065726174" .
            "696f6e223d82d3e4930237222c2f76312f7b706172656e743d70726f6a65" .
            "6374732f2a2f6c6f636174696f6e732f2a7d2f64617461736574733a0764" .
            "617461736574128e010a0a4765744461746173657412292e676f6f676c65" .
            "2e636c6f75642e6175746f6d6c2e76312e47657444617461736574526571" .
            "756573741a1f2e676f6f676c652e636c6f75642e6175746f6d6c2e76312e" .
            "44617461736574223482d3e493022e122c2f76312f7b6e616d653d70726f" .
            "6a656374732f2a2f6c6f636174696f6e732f2a2f64617461736574732f2a" .
            "7d129f010a0c4c6973744461746173657473122b2e676f6f676c652e636c" .
            "6f75642e6175746f6d6c2e76312e4c697374446174617365747352657175" .
            "6573741a2c2e676f6f676c652e636c6f75642e6175746f6d6c2e76312e4c" .
            "6973744461746173657473526573706f6e7365223482d3e493022e122c2f" .
            "76312f7b706172656e743d70726f6a656374732f2a2f6c6f636174696f6e" .
            "732f2a7d2f646174617365747312a5010a0d557064617465446174617365" .
            "74122c2e676f6f676c652e636c6f75642e6175746f6d6c2e76312e557064" .
            "61746544617461736574526571756573741a1f2e676f6f676c652e636c6f" .
            "75642e6175746f6d6c2e76312e44617461736574224582d3e493023f3234" .
            "2f76312f7b646174617365742e6e616d653d70726f6a656374732f2a2f6c" .
            "6f636174696f6e732f2a2f64617461736574732f2a7d3a07646174617365" .
            "741292010a0d44656c65746544617461736574122c2e676f6f676c652e63" .
            "6c6f75642e6175746f6d6c2e76312e44656c657465446174617365745265" .
            "71756573741a1d2e676f6f676c652e6c6f6e6772756e6e696e672e4f7065" .
            "726174696f6e223482d3e493022e2a2c2f76312f7b6e616d653d70726f6a" .
            "656374732f2a2f6c6f636174696f6e732f2a2f64617461736574732f2a7d" .
            "129a010a0a496d706f72744461746112292e676f6f676c652e636c6f7564" .
            "2e6175746f6d6c2e76312e496d706f727444617461526571756573741a1d" .
            "2e676f6f676c652e6c6f6e6772756e6e696e672e4f7065726174696f6e22" .
            "4282d3e493023c22372f76312f7b6e616d653d70726f6a656374732f2a2f" .
            "6c6f636174696f6e732f2a2f64617461736574732f2a7d3a696d706f7274" .
            "446174613a012a129a010a0a4578706f72744461746112292e676f6f676c" .
            "652e636c6f75642e6175746f6d6c2e76312e4578706f7274446174615265" .
            "71756573741a1d2e676f6f676c652e6c6f6e6772756e6e696e672e4f7065" .
            "726174696f6e224282d3e493023c22372f76312f7b6e616d653d70726f6a" .
            "656374732f2a2f6c6f636174696f6e732f2a2f64617461736574732f2a7d" .
            "3a6578706f7274446174613a012a12b5010a11476574416e6e6f74617469" .
            "6f6e5370656312302e676f6f676c652e636c6f75642e6175746f6d6c2e76" .
            "312e476574416e6e6f746174696f6e53706563526571756573741a262e67" .
            "6f6f676c652e636c6f75642e6175746f6d6c2e76312e416e6e6f74617469" .
            "6f6e53706563224682d3e4930240123e2f76312f7b6e616d653d70726f6a" .
            "656374732f2a2f6c6f636174696f6e732f2a2f64617461736574732f2a2f" .
            "616e6e6f746174696f6e53706563732f2a7d1293010a0b4372656174654d" .
            "6f64656c122a2e676f6f676c652e636c6f75642e6175746f6d6c2e76312e" .
            "4372656174654d6f64656c526571756573741a1d2e676f6f676c652e6c6f" .
            "6e6772756e6e696e672e4f7065726174696f6e223982d3e4930233222a2f" .
            "76312f7b706172656e743d70726f6a656374732f2a2f6c6f636174696f6e" .
            "732f2a7d2f6d6f64656c733a056d6f64656c1286010a084765744d6f6465" .
            "6c12272e676f6f676c652e636c6f75642e6175746f6d6c2e76312e476574" .
            "4d6f64656c526571756573741a1d2e676f6f676c652e636c6f75642e6175" .
            "746f6d6c2e76312e4d6f64656c223282d3e493022c122a2f76312f7b6e61" .
            "6d653d70726f6a656374732f2a2f6c6f636174696f6e732f2a2f6d6f6465" .
            "6c732f2a7d1297010a0a4c6973744d6f64656c7312292e676f6f676c652e" .
            "636c6f75642e6175746f6d6c2e76312e4c6973744d6f64656c7352657175" .
            "6573741a2a2e676f6f676c652e636c6f75642e6175746f6d6c2e76312e4c" .
            "6973744d6f64656c73526573706f6e7365223282d3e493022c122a2f7631" .
            "2f7b706172656e743d70726f6a656374732f2a2f6c6f636174696f6e732f" .
            "2a7d2f6d6f64656c73128c010a0b44656c6574654d6f64656c122a2e676f" .
            "6f676c652e636c6f75642e6175746f6d6c2e76312e44656c6574654d6f64" .
            "656c526571756573741a1d2e676f6f676c652e6c6f6e6772756e6e696e67" .
            "2e4f7065726174696f6e223282d3e493022c2a2a2f76312f7b6e616d653d" .
            "70726f6a656374732f2a2f6c6f636174696f6e732f2a2f6d6f64656c732f" .
            "2a7d1299010a0b5570646174654d6f64656c122a2e676f6f676c652e636c" .
            "6f75642e6175746f6d6c2e76312e5570646174654d6f64656c5265717565" .
            "73741a1d2e676f6f676c652e636c6f75642e6175746f6d6c2e76312e4d6f" .
            "64656c223f82d3e493023932302f76312f7b6d6f64656c2e6e616d653d70" .
            "726f6a656374732f2a2f6c6f636174696f6e732f2a2f6d6f64656c732f2a" .
            "7d3a056d6f64656c1296010a0b4465706c6f794d6f64656c122a2e676f6f" .
            "676c652e636c6f75642e6175746f6d6c2e76312e4465706c6f794d6f6465" .
            "6c526571756573741a1d2e676f6f676c652e6c6f6e6772756e6e696e672e" .
            "4f7065726174696f6e223c82d3e493023622312f76312f7b6e616d653d70" .
            "726f6a656374732f2a2f6c6f636174696f6e732f2a2f6d6f64656c732f2a" .
            "7d3a6465706c6f793a012a129c010a0d556e6465706c6f794d6f64656c12" .
            "2c2e676f6f676c652e636c6f75642e6175746f6d6c2e76312e556e646570" .
            "6c6f794d6f64656c526571756573741a1d2e676f6f676c652e6c6f6e6772" .
            "756e6e696e672e4f7065726174696f6e223e82d3e493023822332f76312f" .
            "7b6e616d653d70726f6a656374732f2a2f6c6f636174696f6e732f2a2f6d" .
            "6f64656c732f2a7d3a756e6465706c6f793a012a1296010a0b4578706f72" .
            "744d6f64656c122a2e676f6f676c652e636c6f75642e6175746f6d6c2e76" .
            "312e4578706f72744d6f64656c526571756573741a1d2e676f6f676c652e" .
            "6c6f6e6772756e6e696e672e4f7065726174696f6e223c82d3e493023622" .
            "312f76312f7b6e616d653d70726f6a656374732f2a2f6c6f636174696f6e" .
            "732f2a2f6d6f64656c732f2a7d3a6578706f72743a012a12b7010a124765" .
            "744d6f64656c4576616c756174696f6e12312e676f6f676c652e636c6f75" .
            "642e6175746f6d6c2e76312e4765744d6f64656c4576616c756174696f6e" .
            "526571756573741a272e676f6f676c652e636c6f75642e6175746f6d6c2e" .
            "76312e4d6f64656c4576616c756174696f6e224582d3e493023f123d2f76" .
            "312f7b6e616d653d70726f6a656374732f2a2f6c6f636174696f6e732f2a" .
            "2f6d6f64656c732f2a2f6d6f64656c4576616c756174696f6e732f2a7d12" .
            "c8010a144c6973744d6f64656c4576616c756174696f6e7312332e676f6f" .
            "676c652e636c6f75642e6175746f6d6c2e76312e4c6973744d6f64656c45" .
            "76616c756174696f6e73526571756573741a342e676f6f676c652e636c6f" .
            "75642e6175746f6d6c2e76312e4c6973744d6f64656c4576616c75617469" .
            "6f6e73526573706f6e7365224582d3e493023f123d2f76312f7b70617265" .
            "6e743d70726f6a656374732f2a2f6c6f636174696f6e732f2a2f6d6f6465" .
            "6c732f2a7d2f6d6f64656c4576616c756174696f6e731a49ca4115617574" .
            "6f6d6c2e676f6f676c65617069732e636f6dd2412e68747470733a2f2f77" .
            "77772e676f6f676c65617069732e636f6d2f617574682f636c6f75642d70" .
            "6c6174666f726d42b7010a1a636f6d2e676f6f676c652e636c6f75642e61" .
            "75746f6d6c2e7631420b4175746f4d6c50726f746f50015a3c676f6f676c" .
            "652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c656170" .
            "69732f636c6f75642f6175746f6d6c2f76313b6175746f6d6caa0216476f" .
            "6f676c652e436c6f75642e4175746f4d4c2e5631ca0216476f6f676c655c" .
            "436c6f75645c4175746f4d6c5c5631ea0219476f6f676c653a3a436c6f75" .
            "643a3a4175746f4d4c3a3a5631620670726f746f33"
        ), true);

        static::$is_initialized = true;
    }
}

