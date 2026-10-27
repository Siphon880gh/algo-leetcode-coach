## Expiry times

1. `generate(id, t)`: `exp[id] = t + ttl`.
2. `renew(id, t)`: if `exp.get(id, 0) > t`, set `exp[id] = t + ttl`.
3. `count(t)`: `#{v > t}`; optionally delete expired entries as you go.

Example → counts 1 at time 6 and 0 at time 15; the renew of `aaa` at time 8 is ignored (it expired at 7).

Expiry happens before other actions at the same time, so use strict `>`. An ordered structure keyed by expiry makes count faster, but a map is enough for the given limits.

Time: O(1) generate/renew, O(n) count  
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
