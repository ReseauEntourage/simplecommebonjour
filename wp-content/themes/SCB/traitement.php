<?php


$header="MIME-Version: 1.0\r\n";
		$header.='From:Theophane <test@patate.com>'."\n";
		$header.='Content-Type:text/html; charset="uft-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';

		$message='
		<html>
			<body>
				<div align="center">
					<br />
					<u>Nom de l\'expéditeur :</u>Moi<br />
                    <u>Prénom de l\'expéditeur :</u>Moi<br />
					<u>Mail de l\'expéditeur :</u>rien<br />
					<br />
					salut !
					<br />
				</div>
			</body>
		</html>
		';

		@mail("theophane.duval@gmail.com", "CONTACT - scb.com", $message, $header);
?>