## Clean the text first

1. Replace each character of `!?',;.` with a space and lowercase everything (or keep only letters, mapping the rest to spaces).
2. Split on whitespace.
3. Count the words that are not in `set(banned)`.
4. Return the word with the maximum count; the answer is guaranteed unique.

Replacing punctuation with **spaces** matters: `"ball,ball"` must become two words.

Do not split on spaces alone; punctuation stays glued to the words. Do not delete punctuation without inserting a space, or adjacent words merge.

Time: O(n)  
Space: O(n)

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
