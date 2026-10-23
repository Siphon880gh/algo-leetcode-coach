## Tiny example

Warm-up before full edit distance: delete-only distance.

`a="ab"`, `b="a"`. Delete `b` from `a` → 1 edit.

Table on prefixes: if chars equal, diagonal; else delete costs 1 from either side.

This builds the same **prefix DP habit** as Levenshtein without all three ops yet.


## How

1. Practice LCS / delete-only tables on tiny strings
2. Add replace/insert when ready for full edit distance
3. Keep `dp[i][j]` = answer for prefixes


## Trap

Jumping into three-op edit distance with no prefix-table comfort.

**Fix:** Master equal-char diagonal + one op first.

**Time:** O(mn) · **Space:** O(mn)

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
