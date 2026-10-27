## Tiny example

Keep a few short algorithm skeletons ready:

1. **Binary search for a boundary:** find the first or last index where a condition is true.
2. **Sliding window:** move the right edge, and shrink from the left while the window is invalid.
3. **Union-Find:** `find` and `union`, with path compression.
4. **Topological sort with BFS:** a queue of nodes with no remaining prerequisites.

For each problem, fill in only the problem-specific condition or edge list.

## How

1. Memorize the control flow of each skeleton.
2. Plug in the condition or the graph.
3. Do not rework the `lo` and `hi` arithmetic from scratch under pressure.

## Trap

Copying a template blindly with the wrong condition, which leads to endless off-by-one errors.

**Fix:** Before coding, write one sentence saying what `ok(mid)` means.

**Time:** depends on the template

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
