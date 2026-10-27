## Swap counts, not positions

1. Count letters of both words.
2. For each `x` with `cnt1[x] > 0` and `y` with `cnt2[y] > 0`: move one `x` to word2 and one `y` to word1; if the distinct counts match, return true; undo.
3. Return false.

Examples → false, true, true. Checked against trying every index pair on 400 random word pairs.

When x = y the swap changes nothing, which is still a valid move. Recounting distinct letters takes 26 steps, so the whole search is about 26³ steps regardless of length.

Time: O(len + 26³)  
Space: O(26)

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
