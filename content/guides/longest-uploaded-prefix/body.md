## Amortised pointer

1. `uploaded[1 … n + 1] = false`, `p = 0`.
2. `upload(v)`: `uploaded[v] = true`.
3. `longest()`: while `uploaded[p + 1]`, `p++`; return `p`.

Example → [null, null, 0, null, 1, null, 3].

Videos are never removed, so the prefix only grows and the pointer passes each video at most once across all calls. The extra slot n + 1 stops the loop without a bounds check. Advancing inside `upload` instead works just as well.

Time: O(1) amortised per call  
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
