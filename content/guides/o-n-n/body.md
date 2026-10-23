## Tiny example

You wrote “one loop” over n strings, each up to length n, and inside you do `s += char` on an immutable string.

Outer looks O(n), but:

1. Each string op may copy → hidden quadratic
2. Element work is O(n) → total O(n²)

“O(n)” on paper times out when the **hidden factor** is large or another n sneaks in.


## How

1. Expand what each iteration really costs
2. Check library calls (copy, sort, contains on lists)
3. Re-budget: maybe O(n·cost(element))


## Trap

Trusting a method named `contains` on a list is O(1) because “it’s one call”.

**Fix:** List contains is O(n). Use a set for membership.

**Mindset:** multiply outer iterations by real per-iteration cost.

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
