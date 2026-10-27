## Each pig is one digit in base t + 1

There are `t = minutesToTest // minutesToDie` rounds. Each pig ends in one of `t + 1` states: dies after round 1, after round 2, …, after round `t`, or survives. With `p` pigs the joint outcome has `(t + 1)^p` possibilities, so you can tell apart at most that many buckets — and you can reach it. Label each bucket with a `p`-digit number in base `t + 1`. In round `r`, pig `q` drinks from every bucket whose digit `q` is `r`. The round each pig dies in (or survival) spells the poisoned bucket's label.

Return the smallest `p` with `(t + 1)^p >= buckets`. Loop multiplying by `t + 1` instead of using floating-point logs. `buckets = 1` needs 0 pigs.

With one round (`t = 1`) this is the classic binary search over buckets with pigs as bits: 2^p ≥ buckets.

Do not use `log(buckets) / log(t + 1)` without care — rounding can be off by one. Do not forget the survive state (it is why the base is `t + 1`, not `t`).

Time: O(log buckets)  
Space: O(1)

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
