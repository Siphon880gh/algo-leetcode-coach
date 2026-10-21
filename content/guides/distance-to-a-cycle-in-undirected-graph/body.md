A connected undirected graph has n nodes and n edges, so it contains exactly one cycle. Return an array where entry i is the minimum number of edges from node i to any node on the cycle. For instance, n = 7 with edges [[1,2],[2,4],[4,3],[3,1],[0,1],[5,2],[6,5]] → [1,0,0,0,0,1,2]; a triangle → [0,0,0]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Cycle by elimination

1. Degrees; queue every degree-1 node; pop, mark removed, decrement neighbours, queue those reaching degree 1.
2. Unremoved nodes form the cycle; give them distance 0.
3. BFS outward from all of them at once.

Constructed checks (computed with this method): the two cases above → `[1,0,0,0,0,1,2]`, `[0,0,0]`.

Trees hanging off the cycle are fully peeled, while cycle nodes keep degree at least 2 and are never removed.

Time: O(n)  
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
