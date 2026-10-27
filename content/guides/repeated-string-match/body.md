## Only two counts to try

Let `q = ceil(|b| / |a|)`. Fewer copies are too short to contain `b`.

A match can start anywhere inside the first copy of `a`, so it may spill into one extra copy. Check `b in a * q`, then `b in a * (q + 1)`. More than `q + 1` copies only add positions that repeat the ones already checked.

Use the built-in substring search, or KMP / Rabin-Karp for a guaranteed linear bound.

Do not loop adding copies until some arbitrary length; stop after `q + 1`. Do not forget the quick fail: a letter in `b` that is not in `a` means `-1`.

Time: O((|a| + |b|) · |b|) naive, O(|a| + |b|) with KMP  
Space: O(|a| + |b|)

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
