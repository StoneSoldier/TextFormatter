<?xml version="1.0" encoding="utf-8"?><xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"><xsl:output method="html" encoding="utf-8" indent="no"/><xsl:template match="p"><p><xsl:apply-templates/></p></xsl:template><xsl:template match="br"><br/></xsl:template><xsl:template match="e|i|s"/><xsl:template match="USTREAM"><iframe width="480" height="302" allowfullscreen="" frameborder="0" scrolling="no"><xsl:attribute name="src">http://www.ustream.tv/embed/<xsl:choose><xsl:when test="@vid">recorded/<xsl:value-of select="@vid"/></xsl:when><xsl:otherwise><xsl:value-of select="@cid"/></xsl:otherwise></xsl:choose></xsl:attribute></iframe></xsl:template></xsl:stylesheet>