## Try every prefix

1. c = letter counts of s.
2. For i = 0 … n − 1, while target[:i] can be taken from c: if some remaining letter is > target[i], record target[:i] + the smallest such letter + the rest sorted.
3. Return the last recorded string, or "".

Examples → "bca", "eelt", "". Checked against listing every permutation on 2,000 random cases.

Allowing a letter equal to target[i]: example 3 → "bbaa", which is not strictly greater.

Time: O(n²) (each candidate takes O(n) to build)  
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
