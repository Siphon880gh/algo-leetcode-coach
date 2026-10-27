A directed graph has n nodes, and some nodes hold crystals. Add the fewest new directed edges so that every node either holds a crystal or can be reached from a node that does. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Condense, then count

This assumes a node counts as supplied when it can be reached from a crystal node along directed edges; check the official statement.

1. Find strongly connected components (Tarjan or Kosaraju).
2. Mark components that contain a crystal; compute in-degrees between components.
3. Answer = components with in-degree 0 and no crystal.

Constructed check (run in code): n = 5, crystal at 0, edges 0→1, 2→3, 3→2 → 2. Checked against trying every set of added edges on 300 random graphs with n ≤ 5.

Counting nodes with no incoming edge: the same check → 1 instead of 2 (the cycle 2 ↔ 3 has incoming edges but is unreachable).

Time: O(n + m)  
Space: O(n + m)

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
