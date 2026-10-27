## Double the list at each letter

Start with `res = [""]`. For each character `c`:

- Digit: append `c` to every string in `res`.
- Letter: replace `res` with every string + `c.lower()` and every string + `c.upper()`.

DFS gives the same output: at position `i`, recurse with the character as is, and if it is a letter, also with its case swapped (`c ^ 32` in ASCII).

There are `2^L` results for `L` letters, each of length `n`.

Do not branch on digits; that creates duplicates. Do not deduplicate with a set afterward; branching only on letters never makes duplicates.

Time: O(2^L · n)  
Space: O(2^L · n)

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
