## Tiny example

You wrote "one loop" over n strings, each up to length n. Inside it, you build a string with `s += char`, and strings are immutable.

The outer loop looks O(n), but:

1. Each string operation may copy the whole string, which hides a quadratic cost.
2. The work per element is O(n), so the total is O(n²).

A solution that is "O(n)" on paper can time out when the **hidden factor** is large or another n sneaks in.

## How

1. Spell out what each iteration really costs.
2. Check library calls, such as copying, sorting, or `contains` on a list.
3. Recalculate the total, which may be O(n · cost per element).

## Trap

Assuming a method like `contains` on a list is O(1) because "it is just one call".

**Fix:** `contains` on a list is O(n). Use a set for membership tests.

**Mindset:** multiply the number of iterations by the real cost of each one.

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
