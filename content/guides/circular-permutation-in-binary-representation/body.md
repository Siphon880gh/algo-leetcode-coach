## Gray code XOR start

Return `[start ^ i ^ (i >> 1) for i in range(2ⁿ)]`.

XOR with a constant keeps the one-bit difference between neighbours, the first term is `start ^ 0 = start`, and the Gray code's last term differs from its first in one bit.

`n = 2, start = 3` → `[3,2,0,1]`. Any valid order is accepted, so `n = 3, start = 2` can give `[2,3,1,0,4,5,7,6]`.

Do not search with backtracking; 2¹⁶ terms make that slow. Do not rotate a list by searching for `start` after generating; XOR is simpler and O(1) per term.

Time: O(2ⁿ)  
Space: O(2ⁿ) for the output

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
