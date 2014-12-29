IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[#__tutorial]') AND type in (N'U'))
BEGIN
	DROP TABLE [#__tutorial]
END;