## Tiny example

Push the same sequence, `1, 2, 3`, into a stack and into a queue:

- The stack pops `3, 2, 1`. This is last in, first out (LIFO).
- The queue removes `1, 2, 3`. This is first in, first out (FIFO).

The rule: if the **newest** waiting item should go next, use a stack. If the **oldest** should go next, use a queue.

## How

1. Ask which waiting item must leave next.
2. Choose LIFO or FIFO.
3. Only then choose a container in your language.

## Trap

Using a stack to process BFS levels.

**Fix:** BFS needs FIFO order, so use a queue.

**Time:** O(1) for operations at the ends · **Space:** O(n)

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
