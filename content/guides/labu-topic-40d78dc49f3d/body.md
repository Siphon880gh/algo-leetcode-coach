## Tiny example

Stack vs queue on the same push sequence `1,2,3`:

- Stack pop order: `3,2,1` (LIFO)
- Queue dequeue order: `1,2,3` (FIFO)

Rule: if the **newest** pending item should go next → stack. If the **oldest** → queue.


## How

1. Ask which pending item must leave next
2. Pick LIFO or FIFO
3. Only then pick a language container


## Trap

Using a stack for BFS levels.

**Fix:** BFS needs FIFO (queue).

**Time:** O(1) end ops · **Space:** O(n)

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
