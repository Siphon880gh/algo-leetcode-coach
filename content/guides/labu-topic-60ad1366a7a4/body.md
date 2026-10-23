## Tiny example

Algorithm templates cheat sheet — keep skeletons short:

1. **Binary search bounds** — first/last True template
2. **Sliding window** — move `R`, shrink `L` while invalid
3. **Union-Find** — `find` + `union` with path compression
4. **Topo BFS** — indegree queue

Fill only the problem-specific predicate / edge list.


## How

1. Memorize the skeleton control flow
2. Plug in the predicate or graph
3. Do not rewrite lo/hi math from scratch each time under stress


## Trap

Cargo-culting a template with the wrong predicate (off-by-one forever).

**Fix:** Write one sentence for what `ok(mid)` means before coding.

**Time:** template-dependent

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
