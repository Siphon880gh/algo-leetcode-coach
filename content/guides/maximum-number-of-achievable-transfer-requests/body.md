## Try all subsets

1. For `mask` in `0 .. 2^R − 1`: `delta[from] −= 1`, `delta[to] += 1` for chosen requests.
2. If every `delta` is 0, update `best = max(best, popcount(mask))`.
3. Optionally skip masks with `popcount ≤ best` first.

`n = 5`, example 1 → 5. `n = 3`, `[[0,0],[1,2],[2,1]]` → 3. `n = 4`, a 4-cycle → 4.

Self-requests like `[0,0]` are always safe. Do not try greedy cycle picking; overlapping cycles can make it miss the best set.

Time: O(2^R · (R + n))  
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
