<?php
function md5Sign($spb88d44, $spfcd1b0) { $spb88d44 = $spb88d44 . $spfcd1b0; return md5($spb88d44); } function md5Verify($spb88d44, $sp26d1d6, $spfcd1b0) { $spb88d44 = $spb88d44 . $spfcd1b0; $sp08ed7e = md5($spb88d44); if ($sp08ed7e == $sp26d1d6) { return true; } else { return false; } }