## Precompute in order

1. Backtrack over the sorted characters, choosing positions in increasing order, and append each full combination to a list.
2. `next()` returns `list[idx++]`; `hasNext()` returns `idx < len(list)`.

`"abc"`, length 2 → `"ab"`, `"ac"`, `"bc"`, after which `hasNext` is false.

Do not generate permutations; order within a combination follows the string. Do not regenerate on every call; build once in the constructor.

Time: O(C(n, k) · k) build, O(1) per call  
Space: O(C(n, k) · k)

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
