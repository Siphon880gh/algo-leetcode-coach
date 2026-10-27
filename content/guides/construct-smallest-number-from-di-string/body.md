## Push, flush at I

1. `out = ""`, `st = []`.
2. For `i = 0 … n`: push `i + 1`; if `i = n` or `pattern[i] = I`, pop everything onto `out`.
3. Return `out`.

Examples → 123549876, 4321. Checked against trying permutations in lexicographic order on 200 random patterns.

Each D run of length L needs L + 1 decreasing digits, and using the smallest unused ones reversed keeps every earlier digit as small as possible. Patterns have at most 8 letters, so brute force over permutations also passes.

Time: O(n)  
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
