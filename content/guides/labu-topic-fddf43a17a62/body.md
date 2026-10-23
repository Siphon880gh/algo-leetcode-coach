## Tiny example

Stack/queue patterns:

1. **Next greater** — monotonic decreasing stack on `[2,1,3]` → `2→3`, `1→3`, `3→-1`
2. **Sliding window max** — monotonic deque of indices
3. **BFS** — plain queue

Each maintains an invariant on what the ends mean.


## How

1. Spot next-greater / window / BFS cues
2. Keep the mono invariant while pushing
3. Pop from the end that violates the invariant


## Trap

Pushing to a “monotonic stack” without ever popping — the mono property dies.

**Fix:** Pop while the order would break; then push.

**Time:** amortized O(n) for mono stack/deque passes

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
