## Tiny example

Pick a structure by the operation you do most often:

| Need | Prefer |
|------|--------|
| frequent `a[i]` reads | array or dynamic array |
| inserting at the head, or splicing | linked list |
| many appends | dynamic array (amortized) |
| membership by key | hash set or map |

Example: if you build a list by calling `push_front` again and again, use a linked list (or a deque). If you build it with `append`, use a dynamic array.

## How

1. Name the operation you do most often.
2. Choose the layout that makes it cheap.
3. Think again if that operation changes.

## Trap

Defaulting to one structure for every problem.

**Fix:** Look at the hot path again, and switch structures when the bottleneck changes.

**Time:** depends on how the chosen layout handles the most common operation

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
