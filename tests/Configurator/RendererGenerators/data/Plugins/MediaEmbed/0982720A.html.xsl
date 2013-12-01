<?xml version="1.0" encoding="utf-8"?><xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"><xsl:output method="html" encoding="utf-8" indent="no"/><xsl:template match="p"><p><xsl:apply-templates/></p></xsl:template><xsl:template match="br"><br/></xsl:template><xsl:template match="e|i|s"/><xsl:template match="SOUNDCLOUD"><iframe width="560" height="166" allowfullscreen="" frameborder="0" scrolling="no"><xsl:attribute name="src">https://w.soundcloud.com/player/?url=<xsl:choose><xsl:when test="@secret_token and@playlist_id">https://api.soundcloud.com/playlists/<xsl:value-of select="@playlist_id"/>&amp;secret_token=<xsl:value-of select="@secret_token"/></xsl:when><xsl:when test="@secret_token and@track_id">https://api.soundcloud.com/tracks/<xsl:value-of select="@track_id"/>&amp;secret_token=<xsl:value-of select="@secret_token"/></xsl:when><xsl:otherwise><xsl:value-of select="@id"/><xsl:if test="@secret_token">&amp;secret_token=<xsl:value-of select="@secret_token"/></xsl:if></xsl:otherwise></xsl:choose></xsl:attribute></iframe></xsl:template></xsl:stylesheet>