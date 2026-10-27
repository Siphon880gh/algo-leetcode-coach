## Doubling covers every shift

`return len(s) == len(goal) and goal in s + s`.

A shift by `k` is `s[k:] + s[:k]`, which appears in `s + s` starting at index `k`.

The length check matters: without it, a shorter `goal` that happens to be a substring would pass.

Use KMP or the Z-function on `goal + "#" + s + s` for a guaranteed O(n) search; most built-in searches are fast in practice.

Do not try all `n` rotations with a full compare each; that is O(n²). Do not skip the length check.

Time: O(n) with KMP  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
