<?php 
include '../template/head.php';
include '../template/nav.php';?>

		<header>
			<div id="nav_menu_opener" <?php include 'template/diverses/headdesign.php';?>></div> <!-- in diese Datei müssen alle zusätzlichen Styleanweisungen kommen! -->
			<span>
				Editoren			<!-- Hier der Titel in der blauen?header-Leiste-->
			</span>
		</header>
		<main>
			<article> <!-- Hier der Inhalt-->
				<h1>SSL</h1>
				<p>Wer im Internet sicher kommunizieren möchte greift häufig auf die Verschlüsselung per SSL zurück.
				Dies ist dann am grünen HTTPS in der Adresszeile im Browser zu erkennen. Aber auch der Versand von E-Mails zwischen Mailservern, das Abrufen von E-Mails per IMAP oder POP und das Absenden von E-Mails mit SMTP werden mit SSL-Verschlüsselung vor Kriminellen, Geheimdiensten und anderen ungewollten Zugriffen geschützt.

SSL basiert auf einer A-Symmetrischen Verschlüsselung. Vereinfacht erklärt bedeutet das, es gibt einen privaten/geheimen und einen öffentlichen Schlüssel. Der öffentliche Schlüssel kann Inhalte verschlüsseln, jeder darf/soll ihn kennen, der private Schlüssel kann mit dem öffentlichen Schlüssel verschlüsselte Inhalte entschlüsseln, er muss absolut geheim bleiben.

Ein Beispiel: Beim Aufruf einer Webseite teilt der Webserver dem Browser, der eine Webseite angefragt hat seinen öffentlichen Schlüssel mit. Nun generiert der Browser einen Schlüssel für symmetrische Verschlüsselung (Ver- und Entschlüsselung mit dem selben Schlüssel) , verschlüsselt diesen mit dem dem öffentlichen Schlüssel und sendet ihn zurück zum Webserver. Dieser kann ihn mit seinem privaten Schlüssel entschlüsseln. Nun ist eine sichere, verschlüsselte Kommunikation zwischen Webserver und Browser möglich - beinahe.

Denn es gibt einen wunden Punkt bei dieser Art der Kommunikation: Ein Angreifer der die Leitung zwischen Webserver und Browser kontrolliert könnte den vom Webserver zu Beginn gesendeten öffentlichen Schlüssel austauschen, den symmetrischen Schlüssel erfahren und anschließend die Kommunikation zwischen Browser und Webserver lesen oder manipulieren.

Um das zu verhindern, gibt es sogenannte Zertifizierungsstellen. Diese unterschreiben digital den öffentlichen Schlüssel. Die Browserhersteller liefern die öffentlichen Schlüssel der Zertifizierungsinstanzen mit den Browsern aus. So können
					<table>
						<tr>
							<td></td>
						</tr>
					</table>
				<p>
					<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						
			</article>
<?php 
include '../template/footer.php';
?>