## Search the answer

1. If `m · k > n`, return −1.
2. `ok(d)`: scan with a run counter of bloomed flowers; each time it reaches k, count a bouquet and reset.
3. Binary search `d` in `[min(bloomDay), max(bloomDay)]`.

`[1,10,3,10,2]`, m = 3, k = 1 → 3; k = 2 → −1. `[7,7,7,7,12,7,7]`, m = 2, k = 3 → 12.

Do not count all bloomed flowers; bouquets need adjacency, so reset the run on an unbloomed flower. Use 64-bit for `m · k`.

Time: O(n log max)  
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
