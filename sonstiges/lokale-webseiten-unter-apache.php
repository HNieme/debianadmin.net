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
				<h1>Lokale Webseiten mit Apache</h1>
				<p><b>Wer Webseiten einrichtet, Testumgebungen betreibt oder Webanwendungen bertreibt, wird um einen lokalen Webserver nicht herumkommen. Unter Debian (verwendete Version Debian 7 mit Gnome) ist das mit wenigen Commands erledigt. In diesem Tutorial wird die Installation des Webservers erklärt, wie man ihn dazu bringt, auch auf das für normale User leicht nutzbare Verzeichnis <code>~/public_html</code> zuzugreifen, dort php auszuführen und schlussendlich auch, wie man lokale Domains anlegt.</b><br /></p>
				<span class="warn">ACHTUNG: Diese Anleitung ist nicht für Rechner bzw. Server geeignet, deren Webserver vor Zugriffen aus dem Internet nicht geschützt sind! Die hier beschriebene Konfiguration ist eine Entwicklungsumgebung. Offene WLANs können ein Risikofaktor sein.</span>
				
				
				<h2>Installation des Webservers</h2>
				<p>Zuerst muss der Webserver, hier ein Apache 2, installiert werden:
				<code class="codeblock">apt-get install <a href="https://packages.debian.org/jessie/apache2">apache2</a></code> 

				<br /><br />
				Wer später auch PHP, MySQL und Co nutzen möchte nimmt folgenden Befehl:
				<br /> 
				<code class="codeblock">apt-get install <a href="https://packages.debian.org/jessie/apache2">apache2</a> <a href="https://packages.debian.org/jessie/php5" >php5</a> <a href="https://packages.debian.org/jessie/mysql-server">mysql-server</a></code> 
				wird im Terminal als Root ausgeführt und mit <span class="taste">s</span> + <span class="taste">ENTER</span>  bestätigen. Damit ist der Webserver installiert. Bei MySQL muss auch ein Passwort angelegt werden. Für dieses Passwort sollten nur Zeichen des englischen Sprachraumes genutzt werden. Das Passwort gut merken :D</p>
				
				<h2>userdir-Mod aktivieren</h2>
				<p>Nun geht es daran, das Verzeichnis <code>~/public_html</code> im Browser aufrufbar zu machen.
				<br />
				Dafür erstellst Du zuerst den Ordner public_html in Deinem <code>/home</code> Ordner und gibst ihm anschließend die nötigen Berechtigungen, um dem Webserver den Zugriff zu erlauben. Diesen Befehl als normaler User ausführen.
				<code class="codeblock">mkdir ~/public_html && chmod 755 ~/public_html</code>
				</p>
				<p>
				Mit dem Befehl a2enmod wird das Apache2 userdir Modul aktiviert. Der Befehl erstellt einen symlink auf /etc/apache2/mods-available/userdir.load und /etc/apache2/mods-available/userdir.conf im Ordner /etc/apache2/mods-enable/ . Den Befehl als Root ausführen
				<code class="codeblock">a2enmod userdir</code>

				Anschließend wird der Apache daemon neu gestartet (Root User)
				<code class="codeblock">service apache2 restart</code>
				</p>
				<p>Jetzt sollte eine im Verzeichnis /home/~USERNAME/public_html abgelegte Webseite über den Browser Deines Vertrauens abrufbar sein.</p>
				
				
				
				
				
				
				
				
				
				<h2>PHP im Homeverzeichnis aktivieren</h2>
				<p>Dieser Schritt ist nur notwendig, wenn man PHP nutzen möchte. Ansonsten kann man den Folgenden Schritt überspringen.</p>
				<p>Normalerweise ist PHP im Homeverzeichnis deaktiviert, sodass alle .php-Dateien als mime-type Application/octet-stream behandelt werden und bei Aufruf der Datei heruntergeladen werden.</p>
				<p>Mit <code>nano /etc/apache2/mods-available/php5.conf</code>, ausgeführt als Root, wird die PHP-Konfigurationsdatei geöffnet und die Zeile <code>php_admin_value engine Off</code> auskomentiert, also die Raute vor Beginn des Textes entfernt.</p>
				<p>Unter Debian 8 sieht das ein wenig anders aus, hier muss ein ganzer Block auskommentiert werden: </p>
				<p>Vorher:</p>
				<code class="codeblock">
				&lt;FilesMatch &quot;.+\.ph(p[345]?|t|tml)$&quot;&gt;
<br />    SetHandler application/x-httpd-php
<br />&lt;/FilesMatch&gt;
<br />&lt;FilesMatch &quot;.+\.phps$&quot;&gt;
<br />    &emsp;&emsp;&emsp;&emsp;SetHandler application/x-httpd-php-source
<br />    &emsp;&emsp;&emsp;&emsp;# Deny access to raw php sources by default
<br />    &emsp;&emsp;&emsp;&emsp;# To re-enable it&apos;s recommended to enable access to the files
<br />    &emsp;&emsp;&emsp;&emsp;# only in specific virtual host or directory
<br />    &emsp;&emsp;&emsp;&emsp;Require all denied
<br />&lt;/FilesMatch&gt;
<br /># Deny access to files without filename (e.g. &apos;.php&apos;)
<br />&lt;FilesMatch &quot;^\.ph(p[345]?|t|tml|ps)$&quot;&gt;
<br />    &emsp;&emsp;&emsp;&emsp;Require all denied
<br />&lt;/FilesMatch&gt;
<br />
<br /># Running PHP scripts in user directories is disabled by default
<br />#
<br /># To re-enable PHP in user directories comment the following lines
<br /># (from &lt;IfModule ...&gt; to &lt;/IfModule&gt;.) Do NOT set it to On as it
<br /># prevents .htaccess files from disabling it.
<br />&lt;IfModule mod_userdir.c&gt;
<br />    &emsp;&emsp;&emsp;&emsp;&lt;Directory /home/*/public_html&gt;
<br />        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;php_admin_flag engine Off
<br />    &emsp;&emsp;&emsp;&emsp;&lt;/Directory&gt;
<br />&lt;/IfModule&gt;
</code>				
				</p>
				<p>Nachher:</p>
				<code class="codeblock">
				&lt;FilesMatch &quot;.+\.ph(p[345]?|t|tml)$&quot;&gt;
<br />    SetHandler application/x-httpd-php
<br />&lt;/FilesMatch&gt;
<br />&lt;FilesMatch &quot;.+\.phps$&quot;&gt;
<br />    &emsp;&emsp;&emsp;&emsp;SetHandler application/x-httpd-php-source
<br />    &emsp;&emsp;&emsp;&emsp;# Deny access to raw php sources by default
<br />    &emsp;&emsp;&emsp;&emsp;# To re-enable it&apos;s recommended to enable access to the files
<br />    &emsp;&emsp;&emsp;&emsp;# only in specific virtual host or directory
<br />    &emsp;&emsp;&emsp;&emsp;Require all denied
<br />&lt;/FilesMatch&gt;
<br /># Deny access to files without filename (e.g. &apos;.php&apos;)
<br />&lt;FilesMatch &quot;^\.ph(p[345]?|t|tml|ps)$&quot;&gt;
<br />    &emsp;&emsp;&emsp;&emsp;Require all denied
<br />&lt;/FilesMatch&gt;
<br />
<br /># Running PHP scripts in user directories is disabled by default
<br />#
<br /># To re-enable PHP in user directories comment the following lines
<br /># (from &lt;IfModule ...&gt; to &lt;/IfModule&gt;.) Do NOT set it to On as it
<br /># prevents .htaccess files from disabling it.
<br />#&lt;IfModule mod_userdir.c&gt;
<br />#    &emsp;&emsp;&emsp;&emsp;&lt;Directory /home/*/public_html&gt;
<br />#        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;php_admin_flag engine Off
<br />#    &emsp;&emsp;&emsp;&emsp;&lt;/Directory&gt;
<br />#&lt;/IfModule&gt;
</code>				
				<p>Wie auch in der Konfigurationsdatei auf Englisch beschrieben, darf der Wert, vor allem im Produktivbetrieb, nicht auf <i>On</i> gesetzt werden, weil dadurch <i>.htaccess</i>-Dateien unwirksam würden.</p>
				Anschließend wird mit <code>service apache2 reload</code> die Konfigurationsdatei geladen.
				
				
				
				
				
				
				<h2>Virtuelle Domain anlegen und abrufbar machen</h2>
				<p>Um eine Webseite unter einer lokalen Domain abrufbar zu machen muss zuerst einmal eine lokale Domain hinzugefügt werden. Dazu wird die Datei  <code>/etc/hosts</code> editiert: </p> 
				
				
				<p>Vorher: </p>
				<code class="codeblock">127.0.0.1       localhost<br />
				127.0.1.1       RECHNERNAME.home    	RECHNERNAME<br />
				<br />
				# The following lines are desirable for IPv6 capable hosts<br />
				::1     localhost ip6-localhost ip6-loopback
				<br />ff02::1 ip6-allnodes<br />
				ff02::2 ip6-allrouters</code>
				
				
				<p>Nachher könnte der Eintrag so aussehen:</p>
				<code class="codeblock">127.0.0.1       localhost<br />
				127.0.1.1       RECHNERNAME.home    	RECHNERNAME<br />
				127.0.1.1       DEINEDOMAIN.home <br />
				<br />
				# The following lines are desirable for IPv6 capable hosts<br />
				::1     localhost ip6-localhost ip6-loopback
				<br />ff02::1 ip6-allnodes<br />
				ff02::2 ip6-allrouters</code>
				<p>Domainendungen sollten sein: .localhost, .home, .test <br /> 
				Andere existieren möglicherweise schon im Internet, was dann zu Fehlern führen würde.</p>
				
				<h2>Virtuellen Host unter Apache erstellen</h2>
				<p>Nun muss der Apache noch angewiesen werden, bei Anfragen an die gerade "erstellte" Domain auch die passende Webseite auszuliefern.</p>
				<span class="info">
				In der Standardkonfiguration liefert ein Apache2, egal über welche Domain er die Anfrage bekommt, immer Dateien über den selben Pfad aus, es ist also egal ob man 
				http://127.0.0.1/verzeichnis/index.html oder http://MEINEDOMAIN.localhost/verzeichnis/index.html aufruft. 
				Man wird immer die Datei /var/www/verzeichnis/index.html bekommen. Mit der Erstellung von Virtual Hosts lässt sich das ändern, es können mehrere Domains über eine 
				IP-Adresse auf einem Server angesprochen werden und unterschiedliche Inhalte ausgeliefert werden.
				</span>
				<p>Dafür wird im Verzeichnis <code>/etc/apache2/sites-available/</code> eine Datei mit dem Namen <code>DEINEDOMAIN.home.conf</code> erstellt.
				<br />Diese bekommt folgenden Inhalt: </p>
				<code class="codeblock">
&lt;VirtualHost *:80&gt;<br />
        ServerName <span class="change">DEINEDOMAIN.home</span><br />
        DocumentRoot /home/<span class="change">DEINUSERNAME</span>/www_data/<span class="change">Ordnername</span><br />
        ErrorLog ${APACHE_LOG_DIR}/error.log<br />
        CustomLog ${APACHE_LOG_DIR}/access.log combined<br />
&lt;/VirtualHost&gt;			
				</code>
				<p>Werden mehrere lokale Domains in der <code>/etc/hosts</code> eingetragen, können durch Angabe verschiedener Ordnernamen auch mehrere Projekte synchron genutzt werden. 
				In diesem Fall ist für jedes Projekt eine einzelne Konfiguration als virtual hostnotwendig. 
				Dann wird die Seite aktiviert und die Konfigurationen des Apache neu geladen:</p>	
				<code class="codeblock">
				<span class="command">$ a2ensite debianadmin.localhost.conf</span><br />
Enabling site debianadmin.localhost.<br />
To activate the new configuration, you need to run:<br />
  service apache2 reload<br />
<span class="command">$ service apache2 reload</span>

				</code>
				
				<p>Anschließend muss noch ein Ordner im Ordner <code>public_html</code> angelegt werden, der den in der Virtual-Host Konfigurationsdatei angegebenen Namen trägt. Darin wird die Webseite abgelegt.</p>
				<p>Anschließend kann sie über den Browser unter folgender Adresse abgerufen werden: <code>http://MEINEDOMAIN.home</code>. Wenn andere Domainendungen wie etwa .test oder .localhost verwendet wurden, ist die Adresse entsprechend zu verändern. Es ist auch möglich, das Verzeichnis <code>/home/USERNAME/public_html/</code> anzuzeigen, dies geschieht per <code>http://127.0.0.1/~USERNAME</code>.</p>
				
					
			</article>
<?php 
include '../template/footer.php';
?>