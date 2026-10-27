## Tiny example

The undirected edges are A–B, A–C and B–D.

**Breadth-first search (BFS) from A** uses a queue and visits the graph level by level, for example `A, B, C, D`.

**Depth-first search (DFS) from A** uses a stack or recursion and goes as deep as it can first. One possible order is `A, B, D, C`.

## How

1. Mark nodes as visited so that cycles do not trap you.
2. For BFS, add neighbors to a queue and process them first in, first out.
3. For DFS, recurse into an unvisited neighbor (or push it on a stack) before moving to the next sibling.

## Trap

Forgetting the visited set on an undirected graph. The search bounces between `A` and `B` forever.

**Fix:** Mark a node when you add it to the queue (BFS) or when you recurse into it (DFS), and never process a visited node again.

**Time:** O(V + E) · **Space:** O(V)

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
