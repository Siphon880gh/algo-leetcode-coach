## Degrees decide the shape

1. Build neighbour sets; the root needs degree `n − 1`, else 0.
2. For each non-root `v`: `parent` = neighbour `u` with the smallest degree among those with `deg(u) ≥ deg(v)`.
3. If no parent, or `adj[v] − {parent} ⊄ adj[parent]`, return 0.
4. If `deg(parent) == deg(v)`, mark ambiguity → answer 2; otherwise 1.

`[[1,2],[2,3]]` → 1. `[[1,2],[2,3],[1,3]]` → 2. `[[1,2],[2,3],[2,4],[1,5]]` → 0.

Values are ≤ 500, so subset checks are cheap with sets or bitsets. Return 0 immediately on any failure, even if ambiguity was seen.

Time: O(n · deg)  
Space: O(n + pairs)

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
