## Score and sort

1. `pos`, `neg` = hash sets of the feedback words.
2. For each report: split into words; `points = 3 · (#in pos) − (#in neg)`; pair it with its student id.
3. Sort by `(−points, id)`; return the first `k` ids.

Examples → [1,2], [2,1].

Each student has one report, since ids are unique. Looking words up in lists instead of sets would cost up to 10^4 per word. A size-k heap gives O(n log k) if n is large.

Time: O(total words + n log n)  
Space: O(feedback words + n)

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
