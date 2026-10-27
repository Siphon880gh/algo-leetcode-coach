## Squeeze the whitelist into [0, m)

There are `m = n − |B|` allowed numbers. Draw `r` uniformly from `[0, m)`.

Some `r` in `[0, m)` are blacklisted. Exactly as many numbers in `[m, n)` are allowed (the counts balance). Pair them up:

1. Put the blacklist in a set.
2. `w = m`. For each blacklisted `b < m`: advance `w` while `w` is blacklisted, then `map[b] = w` and `w += 1`.

`pick()`: draw `r`, return `map.get(r, r)`.

Every allowed number has exactly one `r` that leads to it, so the picks are uniform.

Do not store the whitelist; `n` can be 10⁹. Do not use rejection sampling; if most numbers are blacklisted, it needs many draws per pick.

Time: O(|B|) setup, O(1) per pick  
Space: O(|B|)

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
