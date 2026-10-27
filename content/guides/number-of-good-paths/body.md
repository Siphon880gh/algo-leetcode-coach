## Grow the forest from small values up

1. `answer = n` for the single-node paths; every node is its own component with `max = vals[i]`, `count = 1`.
2. Sort edges by `max(vals[a], vals[b])`. For each edge, find the two roots.
3. If their maxima are equal, `answer += countA · countB` and merge the counts; otherwise attach the smaller maximum’s root under the larger one, keeping the larger’s count.
4. Return `answer`.

Examples → 6, 7, 1. Checked against walking every path on 300 random trees.

When an edge with largest end value v is added, every node already joined has value ≤ v, so any path inside the merged part has maximum ≤ v. The answer is at most 3 · 10^4 · 30001 / 2 ≈ 4.5 · 10^8, which fits in 32-bit.

Time: O(n log n)  
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
