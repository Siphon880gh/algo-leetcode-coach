`coins` has `n` values (1-indexed, `n` up to 1000), each from −1 to 100, and `maxJump` is from 1 to 100. You start at index 1 and want to reach index `n`. From index `i` you may jump to `i + 1` … `i + maxJump`, but never onto an index whose coin is −1. Landing on (and starting at) an index costs its coin. Return the indexes of the cheapest path; among cheapest paths return the lexicographically smallest, or `[]` if `n` is unreachable. `[1,2,4,-1,2]`, `maxJump = 2` → `[1,3,5]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Backward DP with next pointers

`f[n] = coins[n]`. For `i` from `n − 1` down to 1 (skipping indexes with coin −1): `f[i] = coins[i] + min f[j]` over `j` in `i + 1 … i + maxJump`, and `nxt[i]` = the **smallest** `j` that achieves that minimum.

If `f[1]` is infinite, return `[]`. Otherwise follow `nxt` from 1 to `n`.

Going backward means each index's best continuation is already known, so tie-breaking on the smallest next index makes the whole path lexicographically smallest. A forward DP that only remembers the previous index cannot do that, because it fixes later indexes before earlier ones.

Do not break ties toward the larger `j`; the problem wants the lexicographically smallest path. Do not forget that the start costs `coins[1]` too, and that a −1 at index 1 or `n` makes the answer `[]`.

Time: O(n · maxJump)  
Space: O(n)

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
