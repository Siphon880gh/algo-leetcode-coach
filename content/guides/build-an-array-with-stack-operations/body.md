## Simulate up to the last target

1. `cur = 1`.
2. For each `x` in target: while `cur < x`, emit Push, Pop and `cur += 1`; then emit Push and `cur += 1`.

`[1,3]`, n = 3 → Push, Push, Pop, Push. `[1,2,3]`, n = 3 → three Push. `[1,2]`, n = 4 → Push, Push.

Do not read the stream past the last target value; n is only an upper bound.

Time: O(max(target))  
Space: O(1) extra

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
