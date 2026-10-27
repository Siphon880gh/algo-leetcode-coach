## Waiting indices

1. Copy the values into `vals`; `ans = [0] · n`.
2. For each `i`: while the stack is non-empty and `vals[stack top] < vals[i]`, pop `j` and set `ans[j] = vals[i]`. Push `i`.
3. Indices left on the stack keep 0.

Return `ans`.

The stack holds values in non-increasing order, so each new value answers a run of smaller ones.

Do not scan forward from every node; that is O(n²). Do not pop on equal values; the next greater value must be strictly larger.

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
