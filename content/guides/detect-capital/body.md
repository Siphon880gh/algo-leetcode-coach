## One count, three cases

Let `cnt` be the number of uppercase letters. The word is valid exactly when `cnt == 0`, or `cnt == len(word)`, or `cnt == 1` and `word[0]` is uppercase.

Library version: `word.isupper() or word.islower() or word.istitle()` — but `istitle` treats other characters specially, so the count is the clear rule here.

Do not accept `cnt == 1` without checking the position — `"leetCode"` has one capital in the wrong place. A one-letter word is valid either way.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
