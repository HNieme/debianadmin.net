<?php 
include '../template/head.php';
include '../template/nav.php';?>

		<header>
			<div id="nav_menu_opener" <?php include 'template/diverses/headdesign.php';?>></div> <!-- in diese Datei müssen alle zusätzlichen Styleanweisungen kommen! -->
			<span>
				Befehle im Terminal		<!-- Hier der Titel in der blauen?header-Leiste-->
			</span>
		</header>
		<main>
			<article> <!-- Hier der Inhalt-->
				<h1>Befehle im Terminal</h1>
					<p>
						Dies ist eine Fortsetzung von <a href="terminal-introduction.php">Einführung ins Terminal</a>. Im Folgenden werden einfache Befehle und wichtige Parameter erklärt
					</p>
				<h2 id="PWD">PWD</h2>
					<p>	
						Der Befehl <code>pwd</code> steht für "Print Working-Direction" gibt das Verzeichnis, in dem man sich aktuell befindet, zurück:
						<br /><br />
						Beispiel: <code class="codeblock"># pwd <br />/var/log</code>
						
					</p>
				<h2 id="LS">LS</h2>
					<p>
						<code>ls</code> listet alle Dateien und Ordner im aktuellen oder angegebenen Verzeichnis auf.
						<br />
						<code>-a</code>: Listet auch versteckte Dateien (<code>.versteckt.txt</code>) auf. Die zu beginn gelisteten 
						Einträge <code>.</code> und <code>..</code> sind ohne Bedeutung, sie repräsentieren das aktuelle Verzeichnis 
						und das übergeordnete Verzeichnis.
						<br /> 
						<code>-a</code>: Zeigt zusätzlich auch <a href="dateibesitzer_und_berechtigungen.php"> Besitzer, Dateirechte,</a> Dateigröße und Änderungsdatum an.
						<br />
						Beispiel:
						<br />
						<code class="codeblock">
							# ls -al
							<br />insgesamt 68
							<br />drwx------  7 root root  4096 Nov 23 21:50 .
							<br />drwxr-xr-x 22 root root  4096 Dez  1 01:00 ..
							<br />-rw-------  1 root root 14610 Dez 16 15:49 .bash_history
							<br />-rw-r--r--  1 root root   570 Jän 31  2010 .bashrc
							<br />drwx------  4 root root  4096 Mär 10  2016 .cache
							<br />-rw-r--r--  1 root root  1347 Mär 10  2016 file.txt
							<br />drwxr-xr-x  2 root root  4096 Mär  6  2016 iptables
							<br />drwxr-xr-x 14 root root  4096 Nov 23 21:57 letsencrypt
							<br />drwxr-xr-x  3 root root  4096 Jän  6  2016 .local
							<br />-rw-------  1 root root   810 Dez 17 16:58 .nano_history
							<br />-rw-r--r--  1 root root   140 Nov 19  2007 .profile
							<br />-rw-------  1 root root  1024 Nov 24 00:33 .rnd
							<br />-rw-r--r--  1 root root    66 Nov 23 21:50 .selected_editor
							<br />drwx------  2 root root  4096 Aug  7 22:44 .ssh
						</code>
						


				<h2 id="CD">CD</h2>
					<p>
						Change Direction
					</p>
				<h2 id="RM">RM</h2>
					<p>
					rm -r
						
					</p>
				<h2 id="">mkdir</h2>
					<p>
						makedirectory
					</p>
				<h2 id="">mv</h2>
					<p>
						move
					</p>
				<h2 id="">grep</h2>
					<p>
						
					</p>
				<h2 id="">more/less</h2>
					<p>
						
					</p>
				<h2 id="">wget</h2>
					<p>
						
					</p>
				<h2 id="">output > file.txt oder >file.txt oder filea fileb filec > file.txt</h2>
					<p>
						
					</p>
				
					
					
					
					
					
					
					<br /><br /><br />
					
					
					
					
					
					
					
					
					
					<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						
			</article>
<?php 
include '../template/footer.php';
?>