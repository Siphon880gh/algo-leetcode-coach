## Tiny example

You need a **queue**: first in, first out. That describes what the operations mean, which is the abstract data type (ADT).

Several memory layouts can implement it:

- A ring buffer inside an array
- Linked nodes with head and tail pointers
- The language's built-in `deque`

The ADT says what the operations do. The physical layout says how memory is arranged. They are separate choices.

## How

1. Name the operations you need and how fast each one must be.
2. Pick a layout that meets those costs.
3. Do not mix up "list" the ADT with "linked list" the layout.

## Trap

Saying "use a list" without saying whether it is backed by an array or by linked nodes. Their costs are very different.

**Fix:** Name the layout whenever Big-O matters.

**Takeaway:** Choose the ADT first, then the implementation.

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
