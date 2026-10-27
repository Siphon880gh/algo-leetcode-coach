Alice and Bob take turns, Alice first. On a turn a player removes any positive number of stones from a single non-empty pile; a player who cannot move loses. Given the pile sizes and assuming optimal play, return true if Alice wins. For instance, [1] → true, [1,1] → false, and [1,2,3] → false. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Nim-sum

Return `p[0] XOR p[1] XOR … ≠ 0`.

Constructed checks (verified against a memoised game search over small random piles): `[1]` → true, `[1,1]` → false, `[1,2,3]` → false.

Why: from XOR 0 every move makes it non-zero; from non-zero XOR there is always a move back to 0 (shrink a pile with the top bit of the XOR set). The empty position has XOR 0 and is a loss. A memoised search works for tiny inputs but explodes quickly.

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
