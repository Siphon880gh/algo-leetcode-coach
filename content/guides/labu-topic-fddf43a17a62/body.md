## Tiny example

Stack and queue patterns:

1. **Next greater element:** use a decreasing stack. On `[2,1,3]`, the next greater value for 2 is 3, for 1 it is 3, and for 3 there is none (-1).
2. **Sliding window maximum:** use a deque of indices whose values decrease from front to back.
3. **BFS:** use a plain queue.

Each pattern keeps a rule about what the ends of the structure hold.

## How

1. Spot the clue: next greater, a sliding window, or BFS.
2. Keep the ordering rule while pushing.
3. Pop from the end where the rule would break.

## Trap

Pushing onto a "monotonic stack" without ever popping. The ordering is lost.

**Fix:** Pop while pushing would break the order, then push.

**Time:** amortized O(n) for a pass with a monotonic stack or deque

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
