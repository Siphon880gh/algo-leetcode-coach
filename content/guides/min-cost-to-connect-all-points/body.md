## Array-based Prim

1. `d[0] = 0`, others ∞.
2. Repeat n times: pick the unused `u` with the smallest `d`; add `d[u]`; update `d[v] = min(d[v], |xu − xv| + |yu − yv|)`.

`[[0,0],[2,2],[3,10],[5,2],[7,0]]` → 20. `[[3,12],[-2,5],[-4,1]]` → 18.

Do not build and sort all n² edges for Kruskal unless n is small; it is O(n² log n) time and O(n²) memory.

Time: O(n²)  
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
