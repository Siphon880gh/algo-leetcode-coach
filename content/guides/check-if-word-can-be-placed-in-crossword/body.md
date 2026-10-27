## Exact-length slots

1. Lines = every row and every column.
2. Split each line on `#`. For each slot with `len(slot) == len(word)`: if every cell is `' '` or matches `word` (or `reversed(word)`), return true.
3. Return false.

Examples → true, false, true.

The neighbour rule means the word must fill a whole slot: a free or lettered cell beside either end would break it, and board edges or `#` are the only valid ends. Checking both directions covers right-to-left and bottom-to-top placements.

Time: O(mn)  
Space: O(m + n) per line

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
