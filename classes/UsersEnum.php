<?php

/**
 * Enum dos usuários do nosso sistema
 * 
 * Enums não são permitidos em php
 * GUEST - 1
 * ENTITY = 2;
 * VOLUNTEER_NATURAL_PERSON = 3;
 * VOLUNTEER_LEGAL_PERSON = 4;
 * MODERATOR = 5;
 * ADMIN = 6;
 */

final class UsersEnum{

	const GUEST = 1;
	const ENTITY = 2;
	const VOLUNTEER_NATURAL_PERSON = 3;
	const VOLUNTEER_LEGAL_PERSON = 4;
	const MODERATOR = 5;
	const ADMIN = 6;
}
?>