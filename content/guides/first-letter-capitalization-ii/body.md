## Per character, knowing the word

1. Recursive CTE over (content_id, text, i, ws, out); ws becomes i + 1 after a space.
2. word = the text from ws to the next space. The character at i is:
   - kept if the word’s first character is not a letter;
   - uppercased if i = ws, or if it follows a hyphen and the word is letter parts joined by single hyphens (`GLOB '*-*'`, no other characters, no trailing or double hyphen);
   - lowercased otherwise.
3. Keep the row with i = length + 1.

Example → Hello World Of Sql, The Quick-Brown Fox, Modern-Day Data Science, Web-Based Front-End Development (run in SQLite). Edge cases matched a Python reference: @home, x-ray, a--b, -ab, ab-, c3PO.

Capitalizing only after spaces: the QUICK-brown fox → The Quick-brown Fox.

Time: O(total length · word length)  
Space: O(total length)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
