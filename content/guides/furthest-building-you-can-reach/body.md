## Min-heap of ladder climbs

1. For each `i`: `d = h[i + 1] − h[i]`; if `d ≤ 0`, continue.
2. Push `d`; if `len(heap) > ladders`, `bricks −= heappop()`.
3. If `bricks < 0`, return `i`. After the loop, return `n − 1`.

`[4,2,7,6,9,14,12]`, 5, 1 → 4. `[4,12,2,7,3,18,20,3,19]`, 10, 2 → 7. `[14,3,19,3]`, 17, 0 → 3.

Ladders end up on the largest climbs seen so far. Do not use bricks greedily first and ladders when they run out; that wastes bricks on big climbs.

Time: O(n log L)  
Space: O(L)

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
