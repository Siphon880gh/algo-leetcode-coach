## Tiny example

Hash fundamentals: upgrade nested scans.

Find if any duplicate in `[3,1,4,1]`:

- Nested loops O(n²)
- Hash set: insert while scanning; `1` already present → duplicate in expected O(n)

First tool when you hear “seen before?” / “frequency of…”.


## How

1. Allocate set/map
2. Query then update (order depends on the problem)
3. Watch mutable keys


## Trap

Using a list as a “set” and calling `in` inside a loop — still O(n²).

**Fix:** Real hash set/map for membership.

**Time:** expected O(n) · **Space:** O(n)

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
