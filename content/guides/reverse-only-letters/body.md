## Swap letters, leave the rest

Turn the string into a list. `i = 0`, `j = n − 1`. While `i < j`:

- If `s[i]` is not a letter, `i += 1`.
- Else if `s[j]` is not a letter, `j −= 1`.
- Else swap, `i += 1`, `j −= 1`.

Join and return.

The letters come out in reverse order and every other character stays at its index.

Do not reverse the whole string and then move symbols back; it is error-prone. Do not test with `isalnum`; digits are not letters here.

Time: O(n)  
Space: O(n) for the list

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
