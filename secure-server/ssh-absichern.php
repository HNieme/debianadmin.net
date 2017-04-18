<?php 
include '../template/head.php';
include '../template/nav.php';?>

		<header>
			<div id="nav_menu_opener" <?php include 'template/diverses/headdesign.php';?>></div> <!-- in diese Datei müssen alle zusätzlichen Styleanweisungen kommen! -->
			<span>
				Lokale Webseiten mit Apache			<!-- Hier der Titel in der blauen?header-Leiste-->
			</span>
		</header>
		<main>
			<article> <!-- Hier der Inhalt-->
				<h1>SSH absichern</h1>
				<p>
					<b>
					Debian-Server (oder allgemein Linux-Server) werden über SSH administriert. 
					SSH steht für Secure Shell und ist Nachfolger des veralteten und unsicheren Telnet. 
					Von Windowsrechnern kann man PUTTY nutzen, um sich mit dem Server zu verbinden, unter Linux funktioniert das direkt aus dem Terminal. 
					</b>
				</p>
				<p>
					Hierzu verwendet man den Befehl <code>ssh -p PORT root@IPADRESSE</code>. 
					Die in CAPS, also Großbuchstaben geschriebenen Begriffe müssen durch die entsprechende Angabe ausgetauscht werden. 
					Die IP-Adresse wird meist in einer Mail vom	Hoster mitgeteilt, jedenfalls bei <?php include '../advertisements/livingbots.php'; ?> ist das so. 
					Der <a href="/erklaerung/wie-funktioniert-das-internet.php">Standardport</a> ist <code>22</code>.
				</p>
				<p>
					SSH ist ein beliebtes Angriffsziel, es vergeht kaum ein Tag, an dem sich nicht mindestens ein Angreifer daran versucht, über SSH den Server zu kapern. 
					Daher tut man gut daran, den Dienst möglichst gut abzusichern. Das wird im folgenden gemacht:
				</p>
				<p>
					Zuerst musst ein neuer Benutzer angelegt werden: <code>adduser USERNAME</code>. 
					Danach wird nach einem Passwort gefragt. Dieses sollte sehr stark sein (etwa 100 Zeichen, bestehend aus Zahlen, Groß- und Kleinbuchstaben sowie Sonderzeichen.) 
					Mehr Info: <a href="/erklaerung/gutes-passwort.php">Was ist ein gutes Passwort?</a>
				</p>
				<p>
 					Anschließend muss die Datei <code>/etc/ssh/sshd_config</code> <a>bearbeitet werden</a>. Im folgenden werden die einzelnen Inhalte erklärt.


				<code class="codeblock">
				# Use these options to restrict which interfaces/protocols sshd will bind to <br />
				#ListenAddress ::<br />
				#ListenAddress 0.0.0.0

				</code>
				<p>
					Die Angabe <code>ListenAdress</code> sagt aus, an welchen IP-Adressen SSH lauscht. Es ist sinnvoll, 2 verschiedene IP-Adressen zu benutzen. 
					Eine für administrative Zwecke (SSH) und eine für alle anderen Dienste (Webserver, Mailserver usw.). 
					Hier musst Du die IP-Adresse, die für administrative Zwecke genutzt werden soll, eintragen und die Zeile auskommentieren 
					(die # am Anfang entfernen), damit die Angabe gültig wird.
				</p>
				<code class="codeblock">
				# What ports, IPs and protocols we listen for <br />
				Port 22
				</code>
				<p>
					Der Port 22 ist der Standardport, über den die meisten Angriffe erfolgen. Ein Ändern des Ports stoppt einen Großteil der Angriffe.
					Unter <a href="https://de.wikipedia.org/wiki/Liste_der_standardisierten_Ports">Wikipedia</a> findet sich eine "Liste der standardisierten Ports". 
					Dort sieht man, welche Ports noch nicht verwendet werden und daher als alternativer SSH-Port verwendet werden können.
				</p>

				





					<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
				</p>			
				
					
			</article>
<?php 
include '../template/footer.php';
?>





<h1></h1>
				