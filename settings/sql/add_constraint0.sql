ALTER TABLE [dbo].[zlecenia] ADD  CONSTRAINT [DF_zlecenia_Status]  DEFAULT ('Nowe') FOR [Status]