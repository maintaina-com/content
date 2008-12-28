<?php

define('AUTH_HANDLER', true);
require dirname(__FILE__) . '/../lib/base.php';
require $CONTENT_DIR . 'lib/Tags/Tagger.php';

$options = array(
    new Horde_Argv_Option('-u', '--user-id', array('type' => 'int')),
    new Horde_Argv_Option('-o', '--object-id', array('type' => 'int')),
);
$parser = new Horde_Argv_Parser(array('optionList' => $options));
list($opts, $tags) = $parser->parseArgs();
if (!$opts->user_id || !$opts->object_id) {
    throw new InvalidArgumentException('user-id and object-id are both required');
}
if (!count($tags)) {
    throw new InvalidArgumentException('List at least one tag to add.');
}

$tagger = new Content_Tagger(array('dbAdapter' => Horde_Db::getAdapter()));
$tagger->tag($opts->user_id, $opts->object_id, $tags);
exit(0);
