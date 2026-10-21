A chocolate bar has chunks with given sweetness values. You cut it into `k + 1` pieces of consecutive chunks, share them with `k` friends, and keep the piece with the least total sweetness. Return the most sweetness you can guarantee for yourself. For instance, `[1,2,3,4,5]` with `k = 1` gives 6 (pieces 1 + 2 + 3 and 4 + 5), and `[5,5,5]` with `k = 2` gives 5. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Search on the minimum piece

1. `lo = min(sweetness)`, `hi = sum // (k + 1)`.
2. `feasible(m)`: walk the chunks, cut when the running sum reaches `m`, count pieces; return `count ≥ k + 1`.
3. Binary search for the largest feasible `m` (use `mid = (lo + hi + 1) // 2` and `lo = mid` on success).

Extra pieces can be merged into the last one, which only raises its sweetness, so "at least k + 1" is the right test.

Do not try all cut positions; that is combinatorial. Do not use the lower midpoint with `lo = mid`; the loop can stall.

Time: O(n log(sum))  
Space: O(1)

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
